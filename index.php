<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <title>Simple Datebase</title>
    <link rel="stylesheet" href="src/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900' rel='stylesheet' type='text/css'>
    <style>

    </style>
</head>
<body>
    <div class="header">
        <div class="logo">
            SimpleDateBase
        </div>
    </div>
    <div class="main" id="app">
        <div class="leftside">
            <ul class="list-menu">
            <li v-on:click="mainMenu(0)" v-bind:class="{ 'active-list-element' : tabCode==0  }">Aktualne rejestry</li>
            <li v-on:click="mainMenu(1)" v-bind:class="{ 'active-list-element' : tabCode==1  }">Dziennik zmian i dostępu</li>
            <li v-on:click="mainMenu(2)" v-bind:class="{ 'active-list-element' : tabCode==2  }">Ustawienia</li>
        </ul>
    </div>
    <div class="centerside">
        <div class="centerside-controls">

        </div>
        <div class="centerside-container">
            <div v-bind:class="{ hidden : tabCode!=0 }" class="centerside-tab">
                <div class="describing">Lista rejestrów utworzonych w organizacji</div>
                <div class="controls-bar">
                    <button class="standard-btn" v-on:click="mainMenu(3)">+ Nowy</button>
                    <div class="checked-section">
                        <span>Z wybranymi: </span>
                        <button class="standard-btn">- Usuń</button>
                        <button class="standard-btn">Zarchiwizuj</button>
                    </div>
                    
                </div>
            </div>
            <div v-bind:class="{ hidden : tabCode!=1  }" class="centerside-tab">

            </div>
            <div v-bind:class="{ hidden : tabCode!=2  }" class="centerside-tab">
                <div class="describing">Zmień ustawienia serwera i domyślne ustawienia klienta systemu</div>
                <div class="section separated-bottom">
                    <h3><i class="fa fa-gear"></i>Ogólne</h3>
                    <div class="subsection">
                        <label><i class="fa fa-globe small-indent" aria-hidden="true"></i>
                            Język:
                            <select>
                                <option value="pl_PL">polski</option>
                            </select>
                        </label>
                    </div>
                    <div><label><input type="checkbox">Automatycznie zapisuj postępy w edycji (w danej karcie) w pamięci przeglądarki</label></div>
                    <div><label><input type="checkbox">Pozwól mi działać również offline</label></div>
                    <div><label><input type="checkbox">Nie wyświetlaj niepotrzebnie informacji oznaczonych jako systemowe</label></div>
                </div>
                <div class="section separated-bottom">
                    <h3><i class="fa fa-window-maximize"></i>Interfejs</h3>
                    <div><label><input type="checkbox">Włącz tryb ciemny</label></div>
                    <fieldset class="box small-box">
                        <legend>Wybierz główny kolor interfejsu</legend>
                        <div class="colorpick">
                            <div class="colorpick-view" v-bind:style="{ 'background-color' : colorPickerColor}"></div>
                            <div class="colorpick-input">
                                <input type="text"  v-model="colorPickerColor">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div v-bind:class="{ hidden : tabCode!=3  }" class="centerside-tab">
                <div class="describing">Utwórz nowy rejestr(tabelę) w bazie danych organizacji</div>
                <div class="row">
                    <input type="text" class="standard-input" placeholder="Nazwa rejestru">
                </div>
                <div class="list-view-section">
                    
                    <div class="controls-bar separated-bottom-top">
                        <button @click="addColumn()">+Add </button>
                        <span :class="{hidden : !showSelectionInfo}" class="adnotation" v-text="'Wybrano '+selectedElements"></span>
                    </div>
                    <ul class="list-view" id="new_columns">
                        <div class="row row-columns" :class="{marked : selection[index]}" v-for="data,index in columnsTemp" @click="markOrUnmark(index)">
                           <div class="subrow">
                            
                                <input v-model="columnsTemp[index].name" @keyup="generateDatabaseName(index)" type="text" class="standard-input">
                              
                         
                               <select>
                                    <option>Tekst</option>
                                    <option>Liczba</option>
                                </select>
                                <div class="controls">
                                    <button class="standard-btn red-btn fa fa-plus" @click="showProperties(index)"></button>
                                    <button class="standard-btn red-btn fa fa-trash-o" @click="deleteColumn(index)"></button>
                                    <button class="standard-btn blue-btn fa fa-clone" @click="cloneColumn(index)"></button>
                                </div>
                            </div>
                            
                            <div class="subrow">
                                <span class="adnotation" v-text="'Nazwa systemowa: '+columnsTemp[index].databaseName"></span>
                            </div>
                            <div class="subrow">
                                <div class="row row-columns">

                                <div class="subrow">

                                
                               <span>Lista własności </span>
                               <button class="standard-btn blue-btn fa fa-clone" @click="newProperty(index)"></button>
                            </div>
                               <ul class="list-view" id="">
                                <div class="row row-columns" v-for="data,indexx in columnsTemp[index].propeties">
                                    <select>
                                        <option>Maska wartości</option>
                                        <option>Maksymalna wartość</option>
                                    </select>
                                    <input v-model="columnsTemp[index].propeties[indexx]" @keyup="generateDatabaseName(index)" type="text" class="standard-input"> 
                                </div>
                               </ul>
                            </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="rightside">

    </div>
</div>
<script>
    

var app = new Vue({
    el: '#app',
    data: {
      message: 'Hello Vue!',
      tabCode : 0,
      columnsTemp : [],
      colorPickerColor : "navy",
      columnNumber : 0,
      selection : [false],
      showSelectionInfo : false,
      selectedElements : 0
    },
    methods : {
        mainMenu: function(x){
            this.tabCode = x;
            window.localStorage["currentLocation"]=this.tabCode;
        },
        isMarked(index){
            console.log("e");
            return this.selection[index];
        },
        addProperty(){

        },
        markOrUnmark(index){
            
            if(this.selection[index]==undefined || this.selection[index]==false){
                this.selection[index]=true;
                this.selectedElements++;
            }else if(this.selection[index]==true){
                this.selection[index]=false;
                this.selectedElements--;
            }
            this.updateView();
            if(this.selection.includes(true)){
                this.showSelectionInfo = true;
            }else{
                this.showSelectionInfo = false;
            }
        },
        newProperty(index){

        },
        func(data){
            return data;
        },
        updateView (){
            this.$forceUpdate();
        },
        cloneColumn(index){
            let x = this.columnsTemp[index];
            this.columnsTemp.splice(index, 0,{"id": index+1, "name": x.name, "databaseName" : x.databaseName, propeties: x.propeties} );
           
            this.updateView();
        },
        changeLocation(location){
            window.localStorage['currentlocation']=location;
        },
        replacePolishLetters(string){
            let polish = ["ą", "ę", "ó", "ń", "ś", "ł", "ź", "ż", "ć"];
            let ascii = ["a", "e", "o", "n", "s", "l", "z", "z","c"];
            polish.forEach((value,index)=>{
                string = string.replaceAll(value, ascii[index]);
            });
            return string;
        },
        addColumn(){
            
            this.columnNumber++;
            this.columnsTemp.push({"id":this.columnsTemp.length, "name" : "", "databaseName": "", propeties : []});
            
            
        },
        generateDatabaseName(index){
            this.columnsTemp[index].databaseName = this.replacePolishLetters(this.columnsTemp[index].name).replaceAll(" ", "_");

        },
        deleteColumn(index){
            
            
          //this.columnsTemp.splice(x, 1);
         let x,y;
         if(index==this.columnsTemp.length-1){
             this.columnsTemp.pop();
         }else{
            x = this.columnsTemp;
         y = x;
         x = y.slice(0,index);
         y = y.slice(index+1);
         console.log(y);
         
         console.log(x);
         this.columnsTemp = x.concat(y);
         }
         
           
           this.columnNumber--;
        }
    },
    mounted() {
        addEventListener("beforeunload", (event) => {
            switch(Number(app.tabCode)){
                case 3:
                    window.localStorage['temp']=JSON.stringify(app.columnsTemp);
                    break;
            }
        });
        if(window.localStorage["currentLocation"]!=undefined){
            this.tabCode=window.localStorage["currentLocation"];
        }else{
            window.localStorage["currentLocation"]=0;
        }
        if(window.localStorage["temp"]!=undefined){
            switch(Number(window.localStorage["currentLocation"])){
                case 3:
                    this.columnsTemp = JSON.parse(window.localStorage["temp"]);
                    break;
            }
        }
        

        
    },
    watch:{
        
    },
   
    
    updated: function () {
  this.$nextTick(function () {
    // Code that will run only after the
    // entire view has been re-rendered
  })}
  });
</script>
</body>
</html>