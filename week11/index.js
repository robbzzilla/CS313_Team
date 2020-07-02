function search() {
    var searchString = $('#text').val();
    console.log('Searching for: ' + searchString);

    var params = { s: searchString, apikey: '1e317915'};

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
       resultList.innerHTML = '';

       for (let i = 0; i < data.Search.length; i++) {
          const title = data.Search[i].Title;
          const content = `<li><p>${title}</p></li>`;
          resultList.innerHTML += content;
       }
    }
}