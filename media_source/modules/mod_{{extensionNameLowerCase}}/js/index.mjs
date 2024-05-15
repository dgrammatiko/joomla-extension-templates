function renderMessage(data) {
  if (!('renderMessages' in Joomla) || typeof Joomla.renderMessages !== 'function') {
    return alert(data.message);
  }

  Joomla.renderMessages({ info: [data.message] });
}

function testajax(e) {
  e.preventDefault();
  const button = e.currentTarget;
  fetch(new URL(button.dataset.url))
    .then((response) => response.json())
    .then((data) => renderMessage(data.data))
    .catch((error) => renderMessage({ error: error.message }));
}

document.querySelectorAll('button.mod_testajax').forEach((button) => button.addEventListener('click', (e) => testajax(e)));
