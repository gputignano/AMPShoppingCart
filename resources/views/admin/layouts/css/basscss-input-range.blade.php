/* Basscss Input Range */

.input-range {
  vertical-align: middle;
  background-color: transparent;
  padding-top: .5rem;
  padding-bottom: .5rem;
  color: inherit;
  background-color: transparent;
  -webkit-appearance: none;
}

.input-range::-webkit-slider-thumb {
  position: relative;
  width: .5rem;
  height: 1.25rem;
  cursor: pointer;
  margin-top: -0.5rem;
  border-radius: 3px;
  background-color: currentcolor;
  -webkit-appearance: none;
}

/* Touch screen friendly pseudo element */
.input-range::-webkit-slider-thumb:before {
  content: '';
  display: block;
  position: absolute;
  top: -0.5rem;
  left: -0.875rem;
  width: 2.25rem;
  height: 2.25rem;
  opacity: 0;
}

.input-range::-moz-range-thumb {
  width: .5rem;
  height: 1.25rem;
  cursor: pointer;
  border-radius: 3px;
  border-color: transparent;
  border-width: 0;
  background-color: currentcolor;
}

.input-range::-webkit-slider-runnable-track {
  height: 0.25rem;
  cursor: pointer;
  border-radius: 3px;
  background-color: rgba(0, 0, 0, .25);
}

.input-range::-moz-range-track {
  height: 0.25rem;
  cursor: pointer;
  border-radius: 3px;
  background-color: rgba(0, 0, 0, .25);
}

.input-range:focus {
  outline: none;
}
