import { useState } from "react";
import { useNavigate } from "react-router-dom";

export default function LoginPage() {
  const [idCardNumber, setIdCardNumber] = useState("");
  const [password, setPassword] = useState("");
  const [errorMessage, setErrorMessage] = useState("");
  const navigate = useNavigate();

  const handleLogin = async (e) => {
    e.preventDefault();
    try {
      const response = await fetch("http://127.0.0.1:8000/api/v1/auth/login", {
        method: "POST",
        credentials: "include",
        mode: "cors",
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          id_card_number: idCardNumber,
          password: password,
        }),
      });

      if (response.ok) {
        const data = await response.json();
        console.log(data);

        navigate("/dashboard");
      } else {
        const data = await response.json();
        setErrorMessage(data.message);
      }
    } catch (err) {
      console.error("Error", err);
      setErrorMessage("Unauthorized User");
    }
  };

  return (
    <>
      <div>
        <nav className="flex justify-between items-center bg-blue-700 h-16">
          <h1 className="text-white font-medium text-xl ml-10">
            Job Seeker Platform
          </h1>
          <a
            href="/"
            className="text-decoration-none text-slate-400 mr-10 text-lg"
          >
            Login
          </a>
        </nav>

        <div className="flex justify-center flex-col items-center">
          <div className="mt-20">
            <h1 className="text-4xl font-normal">Job Seekers Platform</h1>
          </div>
          <div className="mt-10 border w-2/5 h-full shadow-md">
            <div className="font-medium text-2xl border bg-slate-100 ">
              <h1 className="ml-5 my-3">Login</h1>
            </div>
            <div className="flex flex-col gap-5 justify-evenly items-center mt-7 mb-16">
              <form onSubmit={handleLogin}>
                <div>
                  <label
                    htmlFor="id_card_number"
                    className="mr-3 text-xl font-normal"
                  >
                    Id Card Number
                  </label>
                  <input
                    type="text"
                    name="id_card_number"
                    id="id_card_number"
                    value={idCardNumber}
                    onChange={(e) => setIdCardNumber(e.target.value)}
                    className="border rounded-md border-slate-900 w-52"
                  />
                </div>
                <div>
                  <label
                    htmlFor="password"
                    className="mr-3 text-xl ml-14 font-normal"
                  >
                    Password
                  </label>
                  <input
                    type="password"
                    name="password"
                    id="password"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    className="border border-slate-900 rounded-md w-52"
                  />
                </div>
                <div>
                  <button
                    type="submit"
                    className="bg-blue-600 py-1 w-20 rounded-md text-medium text-lg font-normal text-white ml-10"
                  >
                    Login
                  </button>
                </div>
                <p className="text-red-500">{errorMessage}</p>
              </form>
            </div>
          </div>
          <div className="text-lg mt-8 text-slate-500">
            <h4>Copyright &copy; - Web Tech Id</h4>
          </div>
        </div>
      </div>
    </>
  );
}
