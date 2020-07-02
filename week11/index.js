function search() {
    var searchString = $('#text').val();
    console.log('Searching for: ' + searchString);

    var params = { apikey: '1e317915', s: searchString};

    $.get('http://www.omdbapi.com/', params, function(data, status) {
        console.log('Server results: ');
        console.log(status);
        console.log(data);

        updateResultList(data);
    });
}

function updateResultList(data) {
    if(data.Search && data.Search.length > 0) {
       const resultList = $('#resultsList');
       resultList.empty();

       for (let i = 0; i < data.Search.length; i++) {
          const title = data.Search[i].Title;
          const imdbID= data.Search[i].imdbID;
          const content = `<li><button id="${imdbID}" onclick="viewDetail(this.id)">${title}</button></li>`;
          resultList.append(content);
       }
    }
}

function viewDetail(id) {
     var params = { apikey: '1e317915', i: id};
     $.get('http://www.omdbapi.com/', params, function(data, status) {
        console.log('Server results: ');
        console.log(status);
        console.log(data);
        
        createList(data);        
    });
}

function createList(data) {
   for (let i = 0; i < 1; i++)
   {
    const title = data.Title;
    const year = data.Year;
    const rating = data.imdbRating;
    const poster = data.Poster;
    const plot = data.Plot;

    const hTitle = `<h3>${title}</h3>`;
    const imgPoster = `<img src="${poster}" alt="${plot}" width="300" height="auto">`;
    const details = `<p>Year:${year}, IMDB rating:${rating}</p>`;

    const content = `${hTitle}</br>${imgPoster}</br>${details}</br>`;

    infoDiv.innerHTML = content;
    //infoDiv.append(hTitle);
   }
}