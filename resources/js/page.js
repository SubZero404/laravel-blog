import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import VenoBox from "venobox";

new VenoBox({
    selector: '.my-image-links',
    numeration: true,
    infinigall: true,
    share: true,
    spinner: 'rotating-plane'
});
