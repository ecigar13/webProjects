$(document).ready(function () {

  $('.form').on('submit', function (event) {
    event.preventDefault();
    $.ajax({
      type: "POST",
      url: "babynames.php",
      data: $(".form").serialize()
    }).fail(function (msg, status, error) {
      console.log(msg);
      console.log(error);
    }).done(function (msg) {
      console.log("Submitted.");
      let obj = jQuery.parseJSON(msg);
      console.log(obj);
      $('.result').empty();
      $('.result').append("<table id='table'></table>")
      $('#table').append('<tr><th>' + 'Name' + '</th><th>' + 'Ranking' + '</th><th>' + 'Gender' +
      '</th><th>' + 'Year ' + '</th></tr>');
      $('#table').append(jQuery.map(obj, function (objItem) {
        return '<tr><td>' + objItem.name + '</td><td>' + objItem.ranking + '</td><td>' + objItem.gender +
          '</td><td>' + objItem.year + '</td></tr>';
      }));
    }).always(function () {
      console.log($(".form").serialize());
    });
  });
});