document.addEventListener('DOMContentLoaded', function () {
  const relevanceFilter = document.querySelector('.relevance select');
  const timeFilter = document.querySelector('.all-time select');
  const posts = Array.from(document.querySelectorAll('.post'));

  function getDaysFromText(timeText) {
    const timeValue = parseInt(timeText.slice(0, -1));
    const timeUnit = timeText.slice(-1);

    if (timeUnit === 'd') return timeValue;
    if (timeUnit === 'm') return timeValue * 30;
    if (timeUnit === 'y') return timeValue * 365;
    return 0;
  }

  function sortPosts(criteria) {
    const sortedPosts = posts.slice().sort((a, b) => {
      if (criteria === 'likes') {
        return (
          parseInt(b.querySelector('.iconItem span').textContent) -
          parseInt(a.querySelector('.iconItem span').textContent)
        );
      } else if (criteria === 'comments') {
        return (
          parseInt(b.querySelectorAll('.iconItem span')[1].textContent) -
          parseInt(a.querySelectorAll('.iconItem span')[1].textContent)
        );
      }
    });

    updatePosts(sortedPosts);
  }

  function filterPosts(timeframe) {
    const filteredPosts = posts.filter(post => {
      const timeText = post.querySelector('.post_date span').textContent;
      const postDays = getDaysFromText(timeText);

      if (timeframe === 'lastYear') return postDays <= 365;
      if (timeframe === 'lastMonth') return postDays <= 30;
      if (timeframe === 'lastWeek') return postDays <= 7;
      return true;
    });

    updatePosts(filteredPosts);
  }

  function updatePosts(filteredPosts) {
    const container = document.querySelector('.container_post_list');
    while (container.firstChild) {
      container.removeChild(container.firstChild);
    }

    filteredPosts.forEach((post, index) => {
      container.appendChild(post);
      if (index < filteredPosts.length - 1) {
        const separator = document.createElement('hr');
        separator.className = 'separetor__horizontal__post';
        container.appendChild(separator);
      }
    });
  }

  relevanceFilter.addEventListener('change', function () {
    sortPosts(this.value);
  });

  timeFilter.addEventListener('change', function () {
    filterPosts(this.value);
  });

  relevanceFilter.value = 'likes';
  timeFilter.value = 'allTime';
});
