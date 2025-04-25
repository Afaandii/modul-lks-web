import { useForm } from "@inertiajs/react";

export default function UserList() {
    const { data, setData, post } = useForm({
        username: "",
        password: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route("create-user"));
    };
    return (
        <div className="min-h-screen bg-gray-100">
            <div className="flex justify-center align-items-center flex-col">
                <div className="flex justify-center align-items-center flex-col mt-10 mb-10">
                    <h1 className="text-gray-900 font-medium text-center text-4xl mb-5">
                        Manage User - Administrator Portal
                    </h1>
                    <p className="text-gray-400 text-center">
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit.
                    </p>
                </div>
                <form onSubmit={handleSubmit}>
                    <div className="flex justify-center items-center flex-col max-w-md mx-auto gap-5 mt-10">
                        <div className="border rounded-lg p-4 shadow-sm w-full">
                            <label
                                htmlFor="username"
                                className="text-gray-500 text-sm font-medium mb-1 block"
                            >
                                Username <span className="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="username"
                                name="username"
                                placeholder="Username"
                                value={data.username}
                                onChange={(e) =>
                                    setData("username", e.target.value)
                                }
                                className="border rounded-md w-full p-2 text-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                            />
                        </div>
                        <div className="border rounded-lg p-4 shadow-sm w-full">
                            <label
                                htmlFor="password"
                                className="text-gray-500 text-sm font-medium mb-1 block"
                            >
                                Username <span className="text-red-500">*</span>
                            </label>
                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="password"
                                value={data.password}
                                onChange={(e) =>
                                    setData("password", e.target.value)
                                }
                                className="border rounded-md w-full p-2 text-gray-600 focus:outline-none focus:ring focus:border-blue-300"
                            />
                        </div>
                        <div className="flex justify-center align-items-center mt-10 gap-10">
                            <button
                                type="submit"
                                className="btn btn-primary w-full p-2"
                            >
                                Submit
                            </button>
                            <a
                                className="btn btn-error w-full p-3"
                                href={route("user-list")}
                            >
                                Back
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    );
}
