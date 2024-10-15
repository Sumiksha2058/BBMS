document.getElementById('searchForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Get the search value from the input
    var searchValue = document.getElementById('searchInput').value;
    console.log('Search Value:', searchValue); // Add this line for debugging

    // Check if the search value is not empty
    if (searchValue.trim() !== '') {
        // If the search value is not empty, fetch the results
        getSearchResults(searchValue);
    } else {
        // If the search value is empty, clear the search results
        document.getElementById('searchResults').innerHTML = '';
    }
});
