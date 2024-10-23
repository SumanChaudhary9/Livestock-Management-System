document.addEventListener('DOMContentLoaded', function() {
    loadRecords();

    document.getElementById('addAnimalForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const data = new FormData(event.target);
        fetch('add_animal.php', {
            method: 'POST',
            body: data
        }).then(response => response.text())
          .then(data => {
              alert(data);
              event.target.reset();
              loadRecords();
          });
    });

    document.getElementById('addHealthForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const data = new FormData(event.target);
        fetch('add_health.php', {
            method: 'POST',
            body: data
        }).then(response => response.text())
          .then(data => {
              alert(data);
              event.target.reset();
              loadRecords();
          });
    });

    document.getElementById('addBreedingForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const data = new FormData(event.target);
        fetch('add_breeding.php', {
            method: 'POST',
            body: data
        }).then(response => response.text())
          .then(data => {
              alert(data);
              event.target.reset();
              loadRecords();
          });
    });

    document.getElementById('addTransactionForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const data = new FormData(event.target);
        fetch('add_transaction.php', {
            method: 'POST',
            body: data
        }).then(response => response.text())
          .then(data => {
              alert(data);
              event.target.reset();
              loadRecords();
          });
    });
});

function loadRecords() {
    fetch('view_records.php')
        .then(response => response.json())
        .then(data => {
            const recordsDiv = document.getElementById('records');
            recordsDiv.innerHTML = '';

            data.forEach(record => {
                const recordDiv = document.createElement('div');
                recordDiv.classList.add('card', 'mb-3');
                recordDiv.innerHTML = `
                    <div class="card-body">
                        <h5 class="card-title">${record.type}</h5>
                        <p class="card-text">${record.details}</p>
                        <button class="btn btn-secondary" onclick="editRecord(${record.id}, '${record.type}')">Edit</button>
                    </div>
                `;
                recordsDiv.appendChild(recordDiv);
            });
        });
}

function editRecord(id, type) {
    const newValue = prompt(`Edit the ${type} record:`);
    if (newValue) {
        fetch(`edit_record.php?id=${id}&type=${type}&value=${newValue}`, {
            method: 'POST'
        }).then(response => response.text())
          .then(data => {
              alert(data);
              loadRecords();
          });
    }
}
