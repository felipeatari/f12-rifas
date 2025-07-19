import axios from 'axios';
import Swal from 'sweetalert2';
import QRCode from 'qrcode';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Swal = Swal;
window.QRCode = QRCode;
