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
            </div>
            <div v-bind:class="{ hidden : tabCode!=3  }" class="centerside-tab">
                <div class="describing">Utwórz nowy rejestr(tabelę) w bazie danych organizacji</div>
                <div class="row">
                    <input type="text" class="standard-input" placeholder="Nazwa rejestru">
                </div>
                <div class="list-view-section">
                    
                    <div class="controls-bar separated-bottom-top">
                        <button @click="addColumn()">+Add </button>
                    </div>
                    <ul class="list-view" id="new_columns">
                        <div class="row" v-for="data,index in columnsTemp">
                                <input type="text" class="standard-input">
                                <select>
                                    <option>Tekst</option>
                                    <option>Liczba</option>
                                </select>
                                <div class="controls">
                                    <button class="standard-btn red-btn fa fa-plus" @click="addProperty(count)"></button>
                                    <button class="standard-btn red-btn fa fa-trash-o" @click="deleteColumn(index)"></button>
                                    <button class="standard-btn blue-btn fa fa-clone" @click="cloneColumn(index)"></button>
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
      
      columnNumber : 0
    },
    methods : {
        mainMenu: function(x){
            this.tabCode = x;
        },
        addProperty(){

        },
        func(data){
            return data;
        },
        updateView (){
            this.$forceUpdate();
        },
        cloneColumn(){

        },
        addColumn(){
            
            this.columnNumber++;
            this.columnsTemp.push({id : this.columnNumber});
            
            
        },
        deleteColumn(x){
            console.log(x);
            
          //this.columnsTemp.splice(x, 1);
         let x,y;
         if(x==this.columnNumber){
             this.columnsTemp.pop();
         }else if(x==0){
            this.columnsTemp.slice(1);
         }else{
            x = this.columnsTemp;
         y = x;
         x = y.slice(0,index);
         y.slice(-1*(y.length-index));
         
         }
         
           
           this.columnNumber--;
        }
    },
    mounted() {
        
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