function fetchAPI() {
    const urlSelect = document.getElementById('url-select');
    const selectedUrl = urlSelect.value;
  
    fetch(selectedUrl)
      .then(response => response.json())
      .then(data => {
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = JSON.stringify(data);
      })
      .catch(error => {
        const resultDiv = document.getElementById('result');
        resultDiv.innerHTML = `Error: ${error}`;
      });
  }
  
  function clearResult() {
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = '';
  }
  