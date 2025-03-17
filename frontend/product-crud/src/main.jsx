import { StrictMode } from 'react'
import { createRoot } from 'react-dom/client'
// import './index.css'
import App from './App.jsx'
import ProductTable from './components/ProductTable.jsx'

createRoot(document.getElementById('root')).render(
  <StrictMode>
    <ProductTable />
  </StrictMode>,
)
