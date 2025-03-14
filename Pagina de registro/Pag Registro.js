document.getElementById("form").addEventListener("submit", function(event) {
  event.preventDefault();
});

document.getElementById("curso").addEventListener("change", function(event) {
  console.log("Curso seleccionado:", event.target.value);
});

// Función para mostrar/ocultar el formulario de ausentes
function toggleForm() {
  const formContainer = document.getElementById("formContainer");
  formContainer.classList.toggle("hidden");
}

// Función para cambiar el género (alterna entre masculino y femenino)
function toggleGender(button) {
  if (button.classList.contains("male")) {
      button.classList.remove("male");
      button.classList.add("female");
      button.textContent = "Femenino";
  } else if (button.classList.contains("female")) {
      button.classList.remove("female");
      button.textContent = "Género";
  } else {
      button.classList.add("male");
      button.textContent = "Masculino";
  }
}

// Función para marcar/desmarcar excusa
function toggleExcuse(button) {
  button.classList.toggle("active");
}

// Función para eliminar una entrada de estudiante
function removeEntry(button) {
  const studentEntry = button.closest(".student-entry");
  studentEntry.remove();
}

// Función para agregar una nueva entrada de estudiante
function addEntry() {
  const studentsList = document.getElementById("studentsList");

  // Crear nueva entrada
  const newEntry = document.createElement("div");
  newEntry.className = "student-entry";

  // Crear input para número
  const input = document.createElement("input");
  input.className = "texto";
  input.type = "text";
  input.placeholder = "#Número";

  // Crear botón de género
  const genderBtn = document.createElement("button");
  genderBtn.className = "gender";
  genderBtn.textContent = "Género";
  genderBtn.onclick = function () {
      toggleGender(this);
  };

  // Crear botón de excusa
  const excuseBtn = document.createElement("button");
  excuseBtn.className = "excuse";
  excuseBtn.textContent = "E ✓";
  excuseBtn.onclick = function () {
      toggleExcuse(this);
  };

  // Crear botón de eliminar
  const deleteBtn = document.createElement("button");
  deleteBtn.className = "button delete-btn";
  deleteBtn.textContent = "-";
  deleteBtn.onclick = function () {
      removeEntry(this);
  };

  // Agregar elementos a la nueva entrada
  newEntry.appendChild(input);
  newEntry.appendChild(genderBtn);
  newEntry.appendChild(excuseBtn);
  newEntry.appendChild(deleteBtn);

  // Agregar la nueva entrada a la lista
  studentsList.appendChild(newEntry);
}

document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById("absentModal");
  var btn = document.getElementById("absentBtn");
  var modalContent = document.getElementById("modalContent");

  btn.onclick = function() {
      fetch('ausente.html')
          .then(response => response.text())
          .then(data => {
              modalContent.innerHTML = data;
              modal.style.display = "block";

              // Añade esta parte para el botón "X"
              var closeModalBtn = document.getElementById('x');
              if (closeModalBtn) {
                  closeModalBtn.onclick = function() {
                      modal.style.display = "none";
                  };
              }
          });
  }

  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }
});


document.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById("absentModal");
  var btn = document.getElementById("absentBtn");
  var modalContent = document.getElementById("modalContent");

  btn.onclick = function() {
      fetch('ausente.html')
          .then(response => response.text())
          .then(data => {
              modalContent.innerHTML = data;
              modal.style.display = "block";
              document.body.classList.add('modal-open'); // Añade la clase al body

              var closeModalBtn = document.getElementById('x');
              if (closeModalBtn) {
                  closeModalBtn.onclick = function() {
                      modal.style.display = "none";
                      document.body.classList.remove('modal-open'); // Quita la clase del body
                  };
              }
          });
  }

  window.onclick = function(event) {
      if (event.target == modal) {
          modal.style.display = "none";
          document.body.classList.remove('modal-open'); // Quita la clase del body
      }
  }
});