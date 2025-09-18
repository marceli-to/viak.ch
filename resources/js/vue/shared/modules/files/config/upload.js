export default {
  url: "/api/file/upload",
  method: 'post',
  maxFilesize: 24,
  maxFiles: 1,
  createImageThumbnails: false,
  acceptedFiles: '.pdf,.zip,.txt,.doc,.docx,.xls,.xlsx,.ppt,.pptx',
  headers: {
    'Authorization': 'Bearer ' + localStorage.getItem('token')
  }
}