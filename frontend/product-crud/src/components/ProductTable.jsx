import { useEffect, useState } from "react";
import { getProducts, createProduct, updateProduct, deleteProduct } from "../services/productService";
import "../styles/app.css"; // Custom CSS fayl qo'shildi

export default function ProductTable() {
  const [products, setProducts] = useState([]);
  const [modalOpen, setModalOpen] = useState(false);
  const [editingProduct, setEditingProduct] = useState(null);
  const [form, setForm] = useState({ name: "", description: "", price: "" });

  useEffect(() => {
    fetchProducts();
  }, []);

  const fetchProducts = async () => {
    try {
      const data = await getProducts();
      setProducts(data);
    } catch (error) {
      console.error("Error fetching products:", error);
    }
  };

  const handleSave = async () => {
    try {
      if (editingProduct) {
        await updateProduct(editingProduct.id, form);
      } else {
        await createProduct(form);
      }
      setModalOpen(false);
      setEditingProduct(null);
      setForm({ name: "", description: "", price: "" });
      fetchProducts();
    } catch (error) {
      console.error("Error saving product:", error);
    }
  };

  const handleEdit = (product) => {
    setEditingProduct(product);
    setForm({ ...product });
    setModalOpen(true);
  };

  const handleDelete = async (id) => {
    try {
      await deleteProduct(id);
      fetchProducts();
    } catch (error) {
      console.error("Error deleting product:", error);
    }
  };

  return (
    <div className="container">
      <button 
        className="add-btn"
        onClick={() => {
          setForm({ name: "", description: "", price: "" });
          setEditingProduct(null);
          setModalOpen(true);
        }}
      >
        Add Product
      </button>
      <table className="product-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          {products.map((product) => (
            <tr key={product.id}>
              <td>{product.name}</td>
              <td>{product.description}</td>
              <td>${product.price}</td>
              <td>
                <button className="edit-btn" onClick={() => handleEdit(product)}>Edit</button>
                <button className="delete-btn" onClick={() => handleDelete(product.id)}>Delete</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>

      {modalOpen && (
        <div className="modal-overlay">
          <div className="modal">
            <h2>{editingProduct ? "Edit Product" : "Add Product"}</h2>
            <input 
              className="input-field" 
              placeholder="Name" 
              value={form.name} 
              onChange={(e) => setForm({ ...form, name: e.target.value })} 
            />
            <input 
              className="input-field" 
              placeholder="Description" 
              value={form.description} 
              onChange={(e) => setForm({ ...form, description: e.target.value })} 
            />
            <input 
              className="input-field" 
              placeholder="Price" 
              type="number" 
              value={form.price} 
              onChange={(e) => setForm({ ...form, price: e.target.value })} 
            />
            <div className="button-group">
              <button className="save-btn" onClick={handleSave}>{editingProduct ? "Update" : "Create"}</button>
              <button className="close-btn" onClick={() => setModalOpen(false)}>Close</button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
}
