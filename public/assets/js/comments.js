document.addEventListener('DOMContentLoaded', () => {
  const addComment = event => {
    event.preventDefault();

    fetch('/add-comment', {
      method: 'POST',
      body: new FormData(event.target),
    })
      .then(r => r.text())
      .then(text => {
        let form = document.getElementById('add-comment');
        form.insertAdjacentHTML('beforeend', text);
      })
      .catch(error => {
        let form = document.getElementById('add-comment');
        form.insertAdjacentHTML('beforeend', text);
      });
  };

  document.getElementById('add-comment').addEventListener('submit', addComment);
});
