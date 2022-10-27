// Menerapkan Styling Tailwind CSS ke JS

const bodyClass = "bg-blue-500 bg-gradient-to-br from-blue-200 bg-opacity-25";
const bdy       = document.querySelector("body");
bodyClass.split(" ").forEach((cls) => bdy.classList.add(cls));

const calcBodyClass ="max-w-lg rounded overflow-hidden shadow-2xl bg-white bg-opacity-75";
const calcBody      = document.querySelector(".calcBody");
calcBodyClass.split(" ").forEach((cls) => calcBody.classList.add(cls));