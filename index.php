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
    <style>

    </style>
</head>
<body>
    <div class="main" id="app">
        <div class="leftside">
            <ul class="list-menu">
            <li v-on:click="mainMenu(0)">Aktualne rejestry</li>
            <li v-on:click="mainMenu(1)">Dziennik zmian i dostępu</li>
            <li v-on:click="mainMenu(2)">Ustawienia</li>
        </ul>
    </div>
    <div class="centerside">
        <div class="centerside-controls">

        </div>
        <div class="centerside-container">
            <div v-bind:class="{ show : tabCode==0 }" class="centerside-tab">

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
      message: 'Hello Vue!'
    },
    methods : {
        mainMenu: (x)=>{

        }
    }
  });
</script>
</body>
</html>