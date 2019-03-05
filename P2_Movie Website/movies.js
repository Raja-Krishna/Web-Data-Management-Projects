function initialize() {
    document.getElementById("movlist").innerHTML = "";
    document.getElementById("title").innerHTML = "";
    document.getElementById("overview").innerHTML = "";
    document.getElementById("cast").innerHTML = "";
    document.getElementById("genre").innerHTML = "";
}
var currentLocation = document.location.href;
document.getElementById('movlist').innerHTML=currentLocation;
function sendRequest() {
    var xhr = new XMLHttpRequest();
    var query = encodeURI(document.getElementById("form-input").value);
    xhr.open("GET", "proxy.php?method=/3/search/movie&query=" + query);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            var json = JSON.parse(this.responseText);
            var str = JSON.stringify(json, undefined, 2);
            //document.getElementById("output").innerHTML = "<pre>" + str + "</pre>";
            if (json.total_results == 0) {
                document.getElementById('movlist').innerHTML = "Movie not found. Try Again (Title is wrong)";

            }

            for (i = 0; i < json.total_results; i++) {
                var year = json.results[i].release_date;
                var res = year.substring(0, 4);
                document.getElementById('movlist').innerHTML = document.getElementById('movlist').innerHTML + "<li onClick=movClick(" + json.results[i].id + ");>" + json.results[i].title + "&nbsp" + "(" + res + ")" +
                    "</li>";


            }

        }
    };
    document.getElementById("movlist").innerHTML = "";
    document.getElementById("movdet").style.display = "none";
    xhr.send(null);
}

function movClick(movie_id) {
    var xhr = new XMLHttpRequest();
    var query = encodeURI(document.getElementById("form-input").value);
    xhr.open("GET", "proxy.php?method=/3/movie/" + movie_id);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            var json = JSON.parse(this.responseText);

            var year = json.release_date;
            var res = year.substring(0, 4);

            var x22 = "";

            if (json.genres.length == 0) {
                document.getElementById("genre").innerHTML = "No genres for this movie";
            }

            for (i = 0; i < json.genres.length; i++) {
                x22 = x22 + json.genres[i].name + "," + "&nbsp";

            }
            //console.log(json.genres);
            //console.log(json.poster_path);
            //console.log(json.release_date);
            document.getElementById('movdet').style.display = "block";
            document.getElementById('mov').style.display = "block";
            document.getElementById("title").innerHTML = "Title: &nbsp" + json.title + "&nbsp" + "(" + res + ")";
            document.getElementById("overview").innerHTML = "Summary: &nbsp" + json.overview;
            document.getElementById("genre").innerHTML = "Genres: &nbsp" + x22;
            document.getElementById("poster").src = "http://image.tmdb.org/t/p/w185" + json.poster_path;


        }
    };
    xhr.send(null);

    var xhr = new XMLHttpRequest();
    var query = encodeURI(document.getElementById("form-input").value);
    xhr.open("GET", "proxy.php?method=/3/movie/" + movie_id + "/credits");
    xhr.setRequestHeader("Accept", "application/json");
    xhr.onreadystatechange = function () {
        if (this.readyState == 4) {
            var json = JSON.parse(this.responseText);

            //console.log(json.cast);
            var x23 = "";

            if (json.cast == 0)
                document.getElementById("cast").innerHTML = "No cast for this movie";

            for (i = 0; i < 5; i++) {
                x23 = x23 + json.cast[i].name + "," + "&nbsp";

            }

            document.getElementById("cast").innerHTML = "Cast: &nbsp" + x23;
        }
    };
    xhr.send(null);
}
