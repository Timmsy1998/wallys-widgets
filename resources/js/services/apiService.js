import axios from 'axios';

const apiClient = axios.create({
  baseURL: 'http://127.0.0.1:8000/api',
});

export default {
  // Define API methods here
  createOrder(orderData) {
    return apiClient.post('/pack-widgets', orderData);
  },
};
