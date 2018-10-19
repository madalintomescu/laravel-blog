import axios from 'axios';
import { Validator } from 'vee-validate';

Validator.extend('unique', {
  getMessage: (field, args) => {
    return `This ${field} already exists in ${args} table.`;
  },
  validate: (value, args) => {
    return axios(`/api/${args}/${value}`).then(response => {
      return false;
    }).catch(error => {
      return true;
    });
  }
});
