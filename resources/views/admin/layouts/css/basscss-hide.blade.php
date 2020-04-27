/* Basscss Hide */

.hide {
  position: absolute;
  height: 1px;
  width: 1px;
  overflow: hidden;
  clip: rect(1px, 1px, 1px, 1px);
}

@media (max-width: 40em) {
  .xs-hide { display: none }
}

@media (min-width: 40em) and (max-width: 52em) {
  .sm-hide { display: none }
}

@media (min-width: 52em) and (max-width: 64em) {
  .md-hide { display: none }
}

@media (min-width: 64em) {
  .lg-hide { display: none }
}

.display-none { display: none }
