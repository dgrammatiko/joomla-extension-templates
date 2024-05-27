function renderMessage(data) {
  if (!('renderMessages' in Joomla) || typeof Joomla.renderMessages !== 'function') {
    return alert(data.message);
  }

  Joomla.renderMessages({ info: [data.message] });
}

function testajax(e) {
  const button = e.currentTarget;
  fetch(new URL(button.dataset.url))
    .then((response) => response.json())
    .then((data) => renderMessage(data.data))
    .catch((error) => renderMessage({ error: error.message }));
}

document.querySelectorAll("button.mod_{{extensionNameLowerCase}}ajax").forEach((button) => button.addEventListener("click", testajax));
