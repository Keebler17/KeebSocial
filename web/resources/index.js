// thanks w3schools lol
function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

async function API(endpoint, body) {
  const resp = await fetch(endpoint, {
    method: 'POST',
    body: JSON.stringify(body)
  });

  const text = await resp.text();
  return text;
}

// thanks stackoverflow lol
// Returns the value of a GET parameter
function getParam(param) {
  var queryString = location.search;
  let params = new URLSearchParams(queryString);
  let data = params.get(param);
  return data;
}