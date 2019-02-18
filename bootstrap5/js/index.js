function loadXml() {

  //remove elements so there's no duplicate.
  $("tbody").empty();

  //get the xml file
  var request = $.ajax({
    method: "POST",
    url: "books.xml",
    dataType: "text"
  }).fail(function () {
    console.log("Failed.");
  }).always(function () {
    console.log("Complete.");
  }).done(function (msg, status) {
    //parse xml file
    var books = $.trim(msg);
    books = $.parseXML(books);
    books = $(books).find('book');

    //display xml file: Title, Authors (comma separated), Year, Price, Category.
    var contentTable;
    console.log(books);

    $.each(books, function (index, value) {

      var author = $(value).find('author').map(function () {
        return $(this).text();
      }).get().join(', ');
      console.log(author);

      contentTable += '<tr><th scope="row">' + index + '</th>';
      contentTable += '<td>' + $(value).find('title').text() + '</td>'
      contentTable += '<td>' + author +'</td>'
      contentTable += '<td>' + $(value).find('year').text() + '</td>'
      contentTable += '<td>' + $(value).find('price').text() + '</td>'
      contentTable += '<td>' + value.getAttribute('category') + '</td>';
      contentTable += '</tr>';
    });
    $("tbody").append(contentTable);
  });

};