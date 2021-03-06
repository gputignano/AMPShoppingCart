/* Basscss Progress */

.progress {
  display: block;
  width: 100%;
  height: 0.5625rem;
  margin: .5rem 0;
  overflow: hidden;
  background-color: rgba(0, 0, 0, .125);
  border: 0;
  border-radius: 10000px;
  -webkit-appearance: none;
}

.progress::-webkit-progress-bar {
  -webkit-appearance: none;
  background-color: rgba(0, 0, 0, .125)
}

.progress::-webkit-progress-value {
  -webkit-appearance: none;
  background-color: currentcolor;
}

.progress::-moz-progress-bar {
  background-color: currentcolor;
}
