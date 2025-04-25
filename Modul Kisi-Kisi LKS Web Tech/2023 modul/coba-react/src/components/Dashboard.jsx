export default function Dashboard() {
  return (
    <>
      <div>
        <nav className="bg-blue-600 h-16 flex justify-between items-center">
          <h1 className="text-xl font-normal text-white ml-10">
            Job Seekers Platform
          </h1>

          <div className="flex items-center gap-5 mr-10 text-slate-400">
            <h4>User Login Name</h4>
            <a href="#" className="text-decoration-none">
              Logout
            </a>
          </div>
        </nav>

        <div className="flex flex-col">
          <div className="text-5xl ml-14 mt-16 font-thin">
            <h1>Dashboard</h1>
          </div>
          <div className="ml-16 mt-24">
            <h1 className="text-slate-400 text-3xl font-normal">
              My Data Validation
            </h1>

            <div className="flex justify-around items-center">
              <div className="border w-2/6 mt-5">
                <div className="border bg-slate-200 h-14">
                  <h2 className="text-xl font-normal mt-3 ml-5">
                    Data Validation
                  </h2>
                </div>
                <div className="h-32 flex justify-center items-center">
                  <button className="bg-blue-800 rounded-md py-3 w-80 text-white font-normal">
                    +Request Validation
                  </button>
                </div>
              </div>

              <div className="border w-80">
                <div className="border">
                  <h1 className="text-slate-800 text-xl font-normal my-2 ml-3">
                    Data Validations
                  </h1>
                </div>

                <div>
                  <table className="table w-80">
                    <ul>
                      <li className="border border-slate-300 flex gap-32 bg-slate-200 text-md font-medium">
                        <h1 className="my-2 ml-2">Status</h1>
                        <span className="bg-yellow-400 my-2 w-20 text-center rounded-sm ml-4">
                          Accepted
                        </span>
                      </li>
                      <li className="border border-slate-300 flex gap-14 py-2">
                        <h1 className="ml-2">Job Category </h1>
                        <span className="rounded-sm">Computing And IT</span>
                      </li>
                      <li className="border border-slate-300 bg-slate-200 flex gap-24 py-2">
                        <h1 className="ml-2">Job Position </h1>
                        <span className="rounded-sm">Programmer</span>
                      </li>
                      <li className="border border-slate-300 flex gap-12 py-2">
                        <h1 className="ml-2">Reason Accepted </h1>
                        <span className="rounded-sm">I can work hard</span>
                      </li>
                      <li className="border border-slate-300 bg-slate-200 flex py-2">
                        <h1 className="ml-2">
                          Validator{" "}
                          <span className="rounded-sm ml-32">Usman M.Ti</span>
                        </h1>
                      </li>
                      <li className="border border-slate-300 flex gap-24 py-2">
                        <h1 className="ml-2">Validator Notes </h1>
                        <span className="rounded-sm">Siap Kerja</span>
                      </li>
                    </ul>
                  </table>
                </div>
              </div>
              <div className="border w-80">
                <div className="border">
                  <h1 className="text-slate-800 text-xl font-normal my-2 ml-3">
                    Data Validations
                  </h1>
                </div>

                <div>
                  <table className="table w-80">
                    <ul>
                      <li className="border border-slate-300 flex gap-32 bg-slate-200 text-md font-medium">
                        <h1 className="my-2 ml-2">Status</h1>
                        <span className="bg-yellow-400 my-2 w-20 text-center rounded-sm ml-4">
                          Accepted
                        </span>
                      </li>
                      <li className="border border-slate-300 flex gap-14 py-2">
                        <h1 className="ml-2">Job Category </h1>
                        <span className="rounded-sm">Computing And IT</span>
                      </li>
                      <li className="border border-slate-300 bg-slate-200 flex gap-24 py-2">
                        <h1 className="ml-2">Job Position </h1>
                        <span className="rounded-sm">Programmer</span>
                      </li>
                      <li className="border border-slate-300 flex gap-12 py-2">
                        <h1 className="ml-2">Reason Accepted </h1>
                        <span className="rounded-sm">I can work hard</span>
                      </li>
                      <li className="border border-slate-300 bg-slate-200 flex py-2">
                        <h1 className="ml-2">
                          Validator{" "}
                          <span className="rounded-sm ml-32">Usman M.Ti</span>
                        </h1>
                      </li>
                      <li className="border border-slate-300 flex gap-24 py-2">
                        <h1 className="ml-2">Validator Notes </h1>
                        <span className="rounded-sm">Siap Kerja</span>
                      </li>
                    </ul>
                  </table>
                </div>
              </div>
            </div>

            <div className="mt-14">
              <div className="flex justify-between items-center">
                <h1 className="text-slate-400 text-2xl">My Job Appications</h1>
                <button className="bg-blue-700 py-3 w-72 text-lg text-white rounded-md mr-10">
                  + Add Job Applications
                </button>
              </div>
              <div className="bg-yellow-400 h-11 flex justify-start items-center rounded-md mt-5 mr-10">
                <h4 className="text-lg font-extralight ml-5">
                  Your validation must be approved by validator to get the
                  vaccine
                </h4>
              </div>
            </div>

            <div className="mt-20 mb-20 flex justify-around items-center">
              <div className="w-[41%] border border-slate-500">
                <div className="py-3 border border-slate-600">
                  <h1 className="ml-5 text-xl font-normal">
                    PT. Maju Mundur Sejahtera
                  </h1>
                </div>
                <table className="table">
                  <ul>
                    <li className="border bg-slate-200 border-slate-300 flex gap-11 py-2">
                      <h1>Address</h1>
                      <span>
                        Jls. Hos Cjokroaminato (Pasirkaliki) No. 900, DKI
                        Jakarta
                      </span>
                    </li>
                    <li className="border border-slate-300 flex gap-20 py-2">
                      <h1>Position</h1>
                      <ul>
                        <li className="mb-3">
                          Desain Grafis{" "}
                          <span className="bg-yellow-400 py-1 px-1 rounded-md">
                            Pending
                          </span>
                        </li>
                        <li>
                          Programmer{" "}
                          <span className="bg-yellow-400 py-1 px-1 rounded-md">
                            Pending
                          </span>
                        </li>
                      </ul>
                    </li>
                    <li className="border bg-slate-200 border-slate-300 flex gap-20 py-2">
                      <h1>Apply Date</h1>
                      <span>September 12, 2023</span>
                    </li>
                    <li className="border border-slate-300 flex gap-28 py-2">
                      <h1>Notes</h1>
                      <span>I was the better one</span>
                    </li>
                  </ul>
                </table>
              </div>
              <div className="w-[41%] border border-slate-500">
                <div className="py-3 border border-slate-600">
                  <h1 className="ml-5 text-xl font-normal">
                    PT. Maju Mundur Sejahtera
                  </h1>
                </div>
                <table className="table">
                  <ul>
                    <li className="border bg-slate-200 border-slate-300 flex gap-11 py-2">
                      <h1>Address</h1>
                      <span>
                        Jls. Hos Cjokroaminato (Pasirkaliki) No. 900, DKI
                        Jakarta
                      </span>
                    </li>
                    <li className="border border-slate-300 flex gap-20 py-2">
                      <h1>Position</h1>
                      <ul>
                        <li className="mb-3">
                          Desain Grafis{" "}
                          <span className="bg-yellow-400 py-1 px-1 rounded-md">
                            Pending
                          </span>
                        </li>
                        <li>
                          Programmer{" "}
                          <span className="bg-yellow-400 py-1 px-1 rounded-md">
                            Pending
                          </span>
                        </li>
                      </ul>
                    </li>
                    <li className="border bg-slate-200 border-slate-300 flex gap-20 py-2">
                      <h1>Apply Date</h1>
                      <span>September 12, 2023</span>
                    </li>
                    <li className="border border-slate-300 flex gap-28 py-2">
                      <h1>Notes</h1>
                      <span>I was the better one</span>
                    </li>
                  </ul>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
