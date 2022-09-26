export default {
  url: "/api/image/upload",
  method: 'post',
  maxFilesize: 24,
  maxFiles: 1,
  createImageThumbnails: false,
  acceptedFiles: '.png, .jpg, .jpeg',
  headers: {
    'Authorization': 'Bearer ' + localStorage.getItem('token')
  }
}