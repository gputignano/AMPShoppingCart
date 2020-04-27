/* Basscss Btn Outline */

.btn-outline,
.btn-outline:hover {
  border-color: currentcolor;
}

.btn-outline {
  border-radius: 3px;
}

.btn-outline:hover {
  box-shadow: inset 0 0 0 20rem rgba(0, 0, 0, .0625);
}

.btn-outline:active {
  box-shadow: inset 0 0 0 20rem rgba(0, 0, 0, .125),
    inset 0 3px 4px 0 rgba(0, 0, 0, .25),
    0 0 1px rgba(0, 0, 0, .125);
}

.btn-outline:disabled,
.btn-outline.is-disabled {
  opacity: .5;
}
