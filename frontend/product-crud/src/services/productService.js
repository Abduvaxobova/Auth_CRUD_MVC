import axios from "axios";

const API_URL = "http://localhost:8000/api/products"; 

export const getProducts = async () => {
  const response = await axios.get(API_URL);
  return response.data.data;
};

export const createProduct = async (product) => {
  const response = await axios.post(API_URL, product);
  return response.data.data;
};

export const updateProduct = async (id, product) => {
  const response = await axios.put(`${API_URL}/${id}`, product);
  return response.data.data;
};

export const deleteProduct = async (id) => {
  await axios.delete(`${API_URL}/${id}`);
};