import 'flatpickr'
import {French} from 'flatpickr/dist/l10n/fr.js'

flatpickr('.flatpickr', {
    utc: false,
    locale: French,
    altInput: true,
    enableTime: true,
    altFormat: 'F j, Y - H:i',
    time_24hr: true

})
