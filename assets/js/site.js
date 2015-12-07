$(document).ready(function(){
  //alert('Hello World!');
});

$(document).ready(function(){
   $('form.destroy-form').on('submit', function(submit){
       var confirm_message = $(this).attr('data-confirm');
       if (!confirm(confirm_message)){
           submit.preventDefault();
       }
   }) 
});

$(document).ready(function(){
    $('form.ingredient-form').on('submit', function(submit) {
        var x = submit.create('form.ingredient-form');
        document.appendChild();
    })
})
