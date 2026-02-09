import { sx } from "./authLayout.style";
import { Outlet } from "react-router-dom";
import manprologo from "../../assets/manprologo.svg";
import CssBaseline from "@mui/material/CssBaseline";
import Container from "@mui/material/Container";
import Box from "@mui/material/Box";
import Typography from "@mui/material/Typography";

const features = [
  {
    title: "Turn Expertise Into Empowerment",
    desc: "Equip others to lead with confidence",
  },
  {
    title: "Inspire Growth Through Teaching Excellence",
    desc: "Teaching that fuels continuous learning and professional success",
  },
  {
    title: "Teach Today, Shape Tomorrow",
    desc: "Share expertise that builds future leaders",
  },
];

function AuthLayout() {
  return (
    <Container sx={sx.mainContainer}>
      <CssBaseline />
      <Box sx={sx.card}>
        {/* LEFT SIDE */}
        <Box sx={sx.leftPanel}>
          <img src={manprologo} style={{ width: 180 }} />
          <Box sx={{ mt: 3 }}>
            {features.map((item, index) => (
              <Box key={index} sx={{ mb: 2 }}>
                <Typography sx={sx.leftTitle}>{item.title}</Typography>
                <Typography sx={sx.leftDesc}>{item.desc}</Typography>
              </Box>
            ))}
          </Box>
        </Box>
        {/* RIGHT SIDE */}
        <Box sx={sx.rightPanel}>
          <Outlet />
        </Box>
      </Box>
    </Container>
  );
}
export default AuthLayout;
