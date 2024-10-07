function previewImage(event) {
  let input = event.target;
  let reader = new FileReader();

  reader.onload = () => {
    let imagePreview = document.getElementById("imagePreview");
    imagePreview.src = reader.result;
  };

  if (input.files && input.files[0]) {
    reader.readAsDataURL(input.files[0]);
  }
}

function showDetails(key) {
  document.querySelectorAll(".election-"+key).forEach(row => {
  row.addEventListener("click", function() {
  const type = row.getAttribute("data-type");

  document.getElementById("electionType").innerText = type;

  })})
}

function loadCandidats(electionId) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/getCandidats", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      document.getElementById("candidatsList").innerHTML = xhr.response;
    }
  }

  xhr.send("electionId=" + electionId);

  document.querySelectorAll(".election-"+electionId).forEach(row => {
    row.addEventListener("click", function() {
    const type = row.getAttribute("data-type")
  
    document.getElementById("electionType").innerText = type
  
  })})

  document.getElementById("nouveau-candidat").setAttribute("href", "new-candidat-" + electionId)
}

let selectedCandidatId = null;

function selectCandidat(idCandidat) {
  selectedCandidatId = idCandidat;
  console.log("ID du candidat sélectionné : ", selectedCandidatId);
  
  const forms = document.querySelectorAll('[id^="candidatId-"]');
  forms.forEach(function (form) {
    form.value = selectedCandidatId
  })
}

function showForm(electeurId) {
  document.getElementById("form-" + electeurId).style.display = "block";
  document.getElementById("btn-" + electeurId).style.display = "none"
  document.getElementById("form-" + electeurId).action ="vote/" + selectedCandidatId + "-" + electeurId;
};
