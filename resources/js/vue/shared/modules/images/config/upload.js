export default {
  url: "/api/image/upload",
  method: 'post',
  maxFilesize: 32,
  maxFiles: 1,
  createImageThumbnails: false,
  acceptedFiles: '.png, .jpg, .jpeg',
  headers: {
    'Authorization': 'Bearer ' + localStorage.getItem('token')
  }
}