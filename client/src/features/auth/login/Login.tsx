import Typography from "@mui/material/Typography";
import Box from "@mui/material/Box";
import Container from "@mui/material/Container";
import TextField from "@mui/material/TextField";
import Button from "@mui/material/Button";
import { sx } from "./login.style";
import { useState } from "react";
import { useNavigate } from "react-router-dom";

interface formDataStates {
  email: string;
  password: string;
}

function Login() {
  const [email, setEmail] = useState<formDataStates["email"]>("");
  const [password, setPassword] = useState<formDataStates["password"]>("");
  const navigate = useNavigate();

  const handleSubmit = (e: React.SyntheticEvent) => {
    e.preventDefault();

    alert(`${email} and ${password}`);
  };

  return (
    <Container>
      <Box sx={sx.boxContainer}>
        <Box>
          <Typography
            sx={{ color: "#1E7E34", fontWeight: "bold", fontSize: "30px" }}
          >
            Sign In
          </Typography>
        </Box>
        <Box>
          <Box component="form" onSubmit={handleSubmit}>
            <Box sx={sx.credBox}>
              <Box sx={sx.authCredBox}>
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
              </Box>
              <Box sx={sx.buttonGroup}>
                <Button
                  type="submit"
                  sx={{
                    color: "white",
                    fontWeight: "bold",
                    backgroundColor: "#1E7E34",
                  }}
                >
                  Sign In
                </Button>
                <Button
                  variant="outlined"
                  onClick={() => navigate("/auth/register")}
                  sx={{
                    color: "#1E7E34",
                    fontWeight: "bold",
                    borderColor: "#1E7E34",
                  }}
                >
                  Sign Up
                </Button>
              </Box>
            </Box>
          </Box>
        </Box>
      </Box>
    </Container>
  );
}

export default Login;
