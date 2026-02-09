// import CssBaseline from "@mui/material/CssBaseline";
import { sx } from "./register.style";
import { authService } from "../../../services/authService";
import Box from "@mui/material/Box";
import Container from "@mui/material/Container";
import TextField from "@mui/material/TextField";
import Button from "@mui/material/Button";
import Typography from "@mui/material/Typography";
import { useState } from "react";
import { Link } from "react-router-dom";

interface formDataStates {
  firstname: string;
  lastname: string;
  username: string;
  email: string;
  password: string;
  passwordConfirmation: string;
}

function Register() {
  const [firstname, setFirstname] = useState<formDataStates["firstname"]>("");
  const [lastname, setLastname] = useState<formDataStates["lastname"]>("");
  const [username, setUsername] = useState<formDataStates["username"]>("");
  const [email, setEmail] = useState<formDataStates["email"]>("");
  const [password, setPassword] = useState<formDataStates["password"]>("");
  const [passwordConfirmation, setPasswordConfirmation] =
    useState<formDataStates["passwordConfirmation"]>("");

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();
    try {
      const res = await authService.register({
        firstname,
        lastname,
        username,
        email,
        password,
        password_confirmation: passwordConfirmation,
      });
      console.log("Registered", res.data);
    } catch (error: any) {
      console.error("Registration error:", error.response?.data || error);
    }
  };

  return (
    <Container>
      <Box sx={sx.boxContainer}>
        <Box>
          <Typography
            sx={{ color: "#1E7E34", fontWeight: "bold", fontSize: "30px" }}
          >
            Sign Up
          </Typography>
          <Typography sx={{ color: "#6B7280" }}>
            Create your expert account to get started
          </Typography>
        </Box>
        <Box component="form" onSubmit={handleSubmit}>
          <Box sx={sx.credBox}>
            <Box sx={sx.nameCredBox}>
              <TextField
                value={firstname}
                label="First Name"
                onChange={(e) => setFirstname(e.target.value)}
                sx={sx.nameCredField}
              />
              <TextField
                value={lastname}
                label="Last Name"
                onChange={(e) => setLastname(e.target.value)}
                sx={sx.nameCredField}
              />
            </Box>
            <Box sx={sx.authCredBox}>
              <TextField
                value={username}
                label="Username"
                onChange={(e) => setUsername(e.target.value)}
              />
              <TextField
                value={email}
                label="Email"
                onChange={(e) => setEmail(e.target.value)}
              />
              <TextField
                value={password}
                label="Password"
                onChange={(e) => setPassword(e.target.value)}
              />
              <TextField
                value={passwordConfirmation}
                label="Password Confirmation"
                onChange={(e) => setPasswordConfirmation(e.target.value)}
              />
            </Box>
            <Button
              type="submit"
              sx={{
                color: "white",
                backgroundColor: "#1E7E34",
                fontWeight: "bold",
              }}
            >
              Next
            </Button>
          </Box>
        </Box>
        <Box sx={{ color: "#6B7280", mt: "12px", fontSize: 15 }}>
          Already have an account?{" "}
          <Link to="/auth/login" style={{ color: "#1E7E34" }}>
            Sign In
          </Link>
        </Box>
      </Box>
    </Container>
  );
}

export default Register;
