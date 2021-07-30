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

  Array.from(document.querySelectorAll('.validate-comment'))?.forEach(element => {
    element.addEventListener('click', event => {
      const commentId = event.target.getAttribute('data-comment-id');

      let div = document.getElementById('validate-comment');
      let form = div.getElementsByTagName('form')[0];

      form.setAttribute('action', '/admin/validate-comment-' + commentId);
    });
  });

  Array.from(document.querySelectorAll('.delete-comment'))?.forEach(element => {
    element.addEventListener('click', event => {
      const commentId = event.target.getAttribute('data-comment-id');

      let div = document.getElementById('delete-comment');
      let form = div.getElementsByTagName('form')[0];

      form.setAttribute('action', '/admin/delete-comment-' + commentId);
    });
  });

  document.getElementById('add-comment')?.addEventListener('submit', addComment);
});
