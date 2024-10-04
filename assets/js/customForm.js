// Function to preview profile picture
document
  .getElementById("profilePicture")
  .addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
      if (file.size > 1 * 1024 * 1024) {
        alert("File size exceeds 1 MB. Please choose a smaller file.");
        return;
      }
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("profile-preview").src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

// Check required fields in a specific section
function checkRequiredFields(sectionClass) {
  const entries = document.querySelectorAll(sectionClass);
  return Array.from(entries).every((entry) => {
    const inputs = entry.querySelectorAll(
      "input[required], textarea[required]"
    );
    return Array.from(inputs).every((input) => input.value.trim() !== "");
  });
}

// Function to add a new entry to a specific section
function addEntry(
  buttonSelector,
  entrySelector,
  sectionId,
  removeButtonSelector
) {
  document.querySelector(buttonSelector).addEventListener("click", function () {
    if (!checkRequiredFields(entrySelector)) {
      alert(
        "Please fill all required fields in the section before adding more."
      );
      return;
    }

    const entries = document.querySelectorAll(
      `#${sectionId} .${entrySelector.split(".").pop()}`
    );
    if (entries.length > 0) {
      entries[entries.length - 1].style.paddingBottom = "20px"; // Adjust padding
    }

    const newEntry = document.querySelector(entrySelector).cloneNode(true);
    newEntry
      .querySelectorAll("input, textarea")
      .forEach((input) => (input.value = ""));
    document.getElementById(sectionId).appendChild(newEntry);

    toggleRemoveButton(removeButtonSelector, entrySelector);
  });
}

// Function to remove the last entry from a specific section
function removeEntry(removeButtonSelector, entrySelector) {
  document
    .querySelector(removeButtonSelector)
    .addEventListener("click", function () {
      const entries = document.querySelectorAll(entrySelector);
      if (entries.length > 1) {
        entries[entries.length - 1].remove();
      }
      toggleRemoveButton(removeButtonSelector, entrySelector);
    });
}

// Function to toggle remove button visibility based on entry count
function toggleRemoveButton(removeButtonSelector, entrySelector) {
  const entries = document.querySelectorAll(entrySelector);
  const removeButton = document.querySelector(removeButtonSelector);
  removeButton.style.display = entries.length > 1 ? "block" : "none";
}

// Check on page load whether to show or hide remove buttons
document.addEventListener("DOMContentLoaded", function () {
  toggleRemoveButton(".remove-experience", ".experience-entry");
  toggleRemoveButton(".remove-skill", ".skill-entry");
  toggleRemoveButton(".remove-education", ".education-entry");
  toggleRemoveButton(".remove-project", ".project-entry");
  toggleRemoveButton(".remove-reference", ".reference-entry");
});

// Adding/removing entries for different sections
addEntry(
  ".add-experience",
  ".experience-entry",
  "experience-section",
  ".remove-experience"
);
removeEntry(".remove-experience", ".experience-entry");

addEntry(".add-skill", ".skill-entry", "skills-section", ".remove-skill");
removeEntry(".remove-skill", ".skill-entry");

addEntry(
  ".add-education",
  ".education-entry",
  "education-section",
  ".remove-education"
);
removeEntry(".remove-education", ".education-entry");

addEntry(
  ".add-project",
  ".project-entry",
  "projects-section",
  ".remove-project"
);
removeEntry(".remove-project", ".project-entry");

addEntry(
  ".add-reference",
  ".reference-entry",
  "references-section",
  ".remove-reference"
);
removeEntry(".remove-reference", ".reference-entry");
