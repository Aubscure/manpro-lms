import { BrowserRouter, Route, Routes } from "react-router-dom";
import Register from "./features/auth/register/Register";
import Login from "./features/auth/login/Login";
import AuthLayout from "./layouts/authLayout/AuthLayout";


function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route path="/auth" element={<AuthLayout />}>
          <Route path="register" element={<Register />} />
          <Route path="login" element={<Login />} />
        </Route>
      </Routes>
    </BrowserRouter>
  );
}

export default App;
