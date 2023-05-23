function handleAuthorFirstInput(event) {
  const authorFirst = event.target.value;

  if (authorFirst.length < 2) {
    // Don't fetch data until user types at least two characters
    return;
  }

  // Send AJAX request to server to fetch author data
  const url = `/search_authors.php?first=${encodeURIComponent(authorFirst)}`;
  fetch(url)
    .then(response => response.json())
    .then(data => {
      if (data.author) {
        // Populate author_middle and author_last fields
        document.getElementById('author_middle').value = data.author.middle;
        document.getElementById('author_last').value = data.author.last;
      }
    })
    .catch(error => {
      console.error('Error fetching author data:', error);
    });
}
