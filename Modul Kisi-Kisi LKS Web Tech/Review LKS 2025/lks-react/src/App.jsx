import Dashboard from "./components/Dashboard"
import Login from "./components/Login"
import { BrowserRouter as Router, Routes, Route } from "react-router-dom"
import Validation from "./components/Validation"
import JobVacancies from "./components/JobVacancies"
import ShowVacancies from "./components/ShowVacancies"

function App() {

  return (
    <>
    <Router>
      <Routes>
        <Route path="/"  element={<Login />}></Route>
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/validation" element={<Validation /> } />
        <Route path="/job-vacancies" element= {<JobVacancies/>} />
        <Route path="/show-vacancies" element={<ShowVacancies />} />
      </Routes>
    </Router>
    </>
  )
}

export default App
