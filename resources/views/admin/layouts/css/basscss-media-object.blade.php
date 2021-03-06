/* Basscss Media Object */

.media,
.sm-media,
.md-media,
.lg-media {
  margin-left: -.5rem;
  margin-right: -.5rem;
}

.media {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
}

.media-center {
  -webkit-box-align: center;
  -webkit-align-items: center;
      -ms-flex-align: center;
              -ms-grid-row-align: center;
          align-items: center;
}

.media-bottom {
  -webkit-box-align: end;
  -webkit-align-items: flex-end;
      -ms-flex-align: end;
              -ms-grid-row-align: flex-end;
          align-items: flex-end;
}

.media-img,
.media-body {
  padding-left: .5rem;
  padding-right: .5rem;
}

.media-body {
  -webkit-box-flex: 1;
  -webkit-flex: 1 1 auto;
      -ms-flex: 1 1 auto;
          flex: 1 1 auto;
}

@media (min-width: 40em) {
  .sm-media { display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex }
}

@media (min-width: 52em) {
  .md-media { display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex }
}

@media (min-width: 64em) {
  .lg-media { display: -webkit-box; display: -webkit-flex; display: -ms-flexbox; display: flex }
}
