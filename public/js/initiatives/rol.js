document.addEventListener('DOMContentLoaded', function () {
  const followButton = document.getElementById('followButton');
  const joinButton = document.getElementById('joinButton');

  if (followButton) {
    followButton.addEventListener('click', async function (e) {
      e.preventDefault();
      const iniciativaId = this.dataset.iniciativaId;
      const isFollowing = this.classList.contains('following');

      try {
        const response = await fetch(
          `index.php?c=iniciativa&f=${
            isFollowing ? 'removeFollower' : 'assignFollower'
          }&id=${iniciativaId}`,
          {
            method: 'GET',
            headers: {
              Accept: 'application/json',
            },
          },
        );

        const data = await response.json();

        if (data.success) {
          this.classList.toggle('following');
          const icon = isFollowing ? 'regular' : 'solid';
          const text = isFollowing ? 'Seguir' : 'Dejar de seguir';
          this.innerHTML = `<i class="fa-${icon} fa-heart"></i> ${text}`;
        }

        alert(data.message);
      } catch (error) {
        console.error('Error:', error);
        alert('Error al procesar la solicitud');
      }
    });
  }

  if (joinButton) {
    joinButton.addEventListener('click', async function (e) {
      e.preventDefault();
      const iniciativaId = this.dataset.iniciativaId;
      const isMember = this.classList.contains('member');

      try {
        const response = await fetch(
          `index.php?c=iniciativa&f=${
            isMember ? 'removeMember' : 'assignMember'
          }&id=${iniciativaId}`,
          {
            method: 'GET',
            headers: {
              Accept: 'application/json',
            },
          },
        );

        const data = await response.json();

        if (data.success) {
          this.classList.toggle('member');
          const text = isMember ? 'Únete a la Iniciativa' : 'Abandonar Iniciativa';
          this.textContent = text;
        }

        alert(data.message);
      } catch (error) {
        console.error('Error:', error);
        alert('Error al procesar la solicitud');
      }
    });
  }
});
