import { api } from "../lib/axios";

export const authService = {
    register: (data: any) => api.post("/register", data),
    login: (data: any) => api.post("/login", data),
    generateOtp: (data: any) => api.post("/otp/generate", data),
    verifyOtp: (data: any) => api.post("/otp/verify", data),
}