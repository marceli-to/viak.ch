export default {
  license_key: 'gpl',
  branding: false,
  menubar: false,
  statusbar: false,
  plugins: ['lists', 'code', 'link'],
  toolbar: 'undo redo | bold | bullist | link | superscript | removeformat | styleselect',
  paste_as_text: true,
  height: "320px",
  convert_urls: false,
  style_formats_merge: false,
  style_formats: [{
    title: 'Text',
    items: [
      { title: 'Worttrennung deaktivieren', inline: 'span', styles: { "white-space": 'nowrap' } },
      { title: 'Überschrift 1', block : 'h1'},
      { title: 'Überschrift 2', block : 'h2'},
      { title: 'Überschrift 3', block : 'h3'},
    ],
  }],

  //link_list: '/filelist',
};
