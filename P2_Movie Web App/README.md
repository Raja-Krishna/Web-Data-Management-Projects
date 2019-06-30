# Movie Website

 The goal of this project is to learn client-side web programming using JavaScript and AJAX. More specifically, you will create a Web application that displays information about movies.

Your project is to develop a web application to get information about movies, their cast, their posters, etc. This application should be developed using plain JavaScript and Ajax. You should not use any JavaScript library, such as JQuery. Note that everything should be done asynchronously and your web page should never be redrawn/refreshed completely. This means that the buttons or any other input element in your HTML forms must have JavaScript actions, and should not be regular HTTP requests.

Your application should have a text section where one can type a movie title (eg, The Matrix), one "Display Info" button to search, one section to display the search results, and one section to display information about a movie. The search results is an itemized clickable list of movie titles along with their years they were released. When you click on one of these movie titles, you display information about the movie: the poster of the movie as an image, the movie title, its genres (separated by comma), the movie overview (summary), and the names of the top five cast members (ie, actors who play in the movie).

You need to use the following TMDb HTTP methods listed in [The Movie Database API](http://docs.themoviedb.apiary.io/):

* */3/search/movie:* Search for movies by title.
* */3/movie/{id}:* Get the basic movie information for a specific movie id.
* */3/movie/{id}/credits:* Get the cast and crew information for a specific movie id.

You need to call the TMDb web service through the proxy.php. For example, to get information about the movie "The Matrix" (which has id 603), you use the HTTP call proxy.php?method=/3/movie/603 (it doesn't need the API key -- it's already in the proxy). To search for the movie "matrix", you call proxy.php?method=/3/search/movie&query=matrix.
To display an image, prepend this http://image.tmdb.org/t/p/w185/ to the image path.

Note that there is a lot of information returned by these web services. You need to use very few parts of this information only. 