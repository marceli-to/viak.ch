<style>
@font-face {
  font-family: 'EffraRegular';
  src: url('{{ url("/") }}/assets/fonts/EffraRegular.ttf') format("truetype");
  font-weight: 400;
  font-style: normal; 
}

@font-face {
  font-family: 'EffraBold';
  src: url('{{ url("/") }}/assets/fonts/EffraBold.ttf') format("truetype");
  font-weight: 700;
  font-style: normal; 
}

body {
  color: #000000;
  font-size: 10pt;
  font-family: 'EffraRegular', Helvetica, Arial, sans-serif;
  font-weight: 400;
  line-height: 1;
  text-rendering: optimizeLegibility;
}

strong {
  font-family: 'EffraBold', Helvetica, Arial, sans-serif;
  font-weight: 700;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

td {
  padding: 0;
}

th {
  font-family: 'EffraRegular', Helvetica, Arial, sans-serif;
  font-weight: 400;
  text-align: left;
}

img {
  border: 0;
  vertical-align: middle;
}

table {
  width: 100%;
}

table td {
  text-align: left;
  vertical-align: top;
}

h1, h2, h3 {
  font-family: 'EffraBold', Helvetica, Arial, sans-serif;
  font-weight: 700;
}

p {
  margin-bottom: 5mm;
}

/* Helpers */
.align-right {
  text-align: right;
}

.align-left {
  text-align: left;
}

.clearfix:after {
  visibility: hidden;
  display: block;
  font-size: 0;
  content: " ";
  clear: both;
  height: 0;
}

/* Header */
.header {
  display: inline-block;
  height: 11.7mm;
  left: 0;
  position: fixed;
  top: 6mm;
  width: 162mm;
  z-index: 100;
}

.header img {
  display: block;
  height: auto;
  width: 100%;
}

.break {
  page-break-after: always;
}

.page {
  margin-top: 0;
  position: relative;
  width: 164mm;
  z-index: 100;
}

.page__info,
.page__title,
.page__date,
.page__content {
  left: 0;
  position: absolute;
}

.page__info {
  top: 42mm;
  width: 164mm;
}

.page__info td:first-child {
  width: 36mm;
}

.page__title {
  font-size: 16pt;
  font-family: 'EffraBold', Helvetica, Arial, sans-serif;
  font-weight: 700;
  line-height: .9;
  top: 85mm;
}

.page__date {
  font-family: 'EffraBold', Helvetica, Arial, sans-serif;
  font-weight: 700;
  top: 110mm;
}

.page__content {
  padding-top: 124mm;
  top: 0;
  width: 164mm;
}

.content-table {
  margin-bottom: 10mm;
  width: 100%;
}

.content-table tbody tr:first-of-type {
  border-top: .1mm solid #000000;
}

.content-table td:first-child {
  width: 36mm;
}

.content-table th, 
.content-table td {
  padding: 1mm 0 2mm 0;
}

.content-table tr {
  border-bottom: .1mm solid #000000;
}

.content-table .content-table__footer {
  border-bottom: .4mm solid #000000;
}

</style>