const apiUrl = 'https://geo.api.gouv.fr/communes?nom=';
const cityInput = document.querySelector('#cityName');
console.log(cityInput);
const suggestionsCity = document.querySelector('#suggestions');
cityInput.addEventListener('input', () => {
const inputValue = cityInput.value.trim();
if (inputValue.length >= 2) {
  fetch(apiUrl + inputValue + '&fields=codesPostaux,mairie&boost=population&limit=5')
    .then(response => response.json())
    .then(data => {
      displaySuggestions(data);
    })
    .catch(error => {
      console.error('Error fetching data:', error);
    });
} else {
  suggestionsCity.innerHTML = '';
}
});
function displaySuggestions(suggestions) {
    suggestionsCity.innerHTML = '';
    suggestions.forEach(suggestion => {
    const suggestionCity = document.createElement('div');
    suggestionCity.className = 'autocomplete-suggestion';
    suggestionCity.textContent = suggestion.nom+' '+suggestion.codesPostaux;
    suggestionCity.addEventListener('click', () => {
        let codePostale = suggestion.codesPostaux;
        cityInput.value = suggestion.nom + ' ' + codePostale[0];
        suggestionsCity.innerHTML = '';
    });
        suggestionsCity.appendChild(suggestionCity);
    });
}