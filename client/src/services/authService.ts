import { api } from "../lib/axios";

export const authService = {
    register: (data: any) => api.post("/register", data),
}