import { sx } from "./otp.style";
import { useEffect, useState } from "react";
import Typography from "@mui/material/Typography";
import Box from "@mui/material/Box";
import Container from "@mui/material/Container";
import TextField from "@mui/material/TextField";
import Button from "@mui/material/Button";
import { useLocation, useNavigate } from "react-router-dom";
import { authService } from "../../../services/authService";

function Otp() {
  const [otpCode, setOtpCode] = useState<string | null>("");

  const location = useLocation();
  const navigate = useNavigate();

  // const { email, type } = location.state as {
  //   email: string;
  //   type: "registration" | "login";
  // };

  const state = location.state as { email: string; type: "registration" | "login" } | null;

  useEffect(() => {
    if (!state || !state.email || !state.type) {
      // If state is missing, redirect back to login
      navigate("/auth/login");
    }
  }, [state, navigate]);

  if (!state) return null; // wait until redirect happens

  const { email, type } = state;

  const handleSubmit = async (e: React.SyntheticEvent) => {
    e.preventDefault();
    if (!otpCode) return alert("Please enter OTP");

    try {
      const res = await authService.verifyOtp({ email, otp_code: otpCode, type });
      alert (res.data.message);

      if (type === "registration") {
        navigate("/auth/login")
      } else if (type === "login") {
        localStorage.setItem("token", res.data.token);
        navigate("/auth/register");
      }
    } catch (err: any) {
      console.error(err.response?.data || "Failed to login dashboard");
      alert(err.response?.data?.message || "OTP verification failed");
    }
  };

  return (
    <Container>
      <Box sx={sx.boxContainer}>
        <Box>
          <Typography
            sx={{ color: "#1E7E34", fontWeight: "bold", fontSize: "30px" }}
          >
            OTP Verification
          </Typography>
          <Typography sx={{ color: "#6B7280" }}>
            We've sent a verification code to your email
          </Typography>
        </Box>
        <Box component="form" onSubmit={handleSubmit}>
          <Box sx={sx.credBox}>
            <TextField
              value={otpCode}
              label="One Time Password (OTP)"
              onChange={(e) => setOtpCode(e.target.value)}
            />
            <Button
              type="submit"
              sx={{
                color: "white",
                fontWeight: "bold",
                backgroundColor: "#1E7E34",
              }}
            >
              Verify Otp
            </Button>
            <Button
              type="button"
              variant="outlined"
              sx={{ borderColor: "#1E7E34", color: "#1E7E34" }}
            >
              Resend OTP
            </Button>
          </Box>
        </Box>
      </Box>
    </Container>
  );
}

export default Otp;
