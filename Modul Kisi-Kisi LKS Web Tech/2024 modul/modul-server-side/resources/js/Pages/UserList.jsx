import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";

export default function UserList({ auth, user }) {
    return (
        <>
            <AuthenticatedLayout
                user={auth.user}
                header={
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        User List
                    </h2>
                }
            >
                <Head title="User List" />

                <section className="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
                    <div className="overflow-x-auto">
                        <a
                            className="btn btn-primary mb-6 text-white"
                            href={route("user-form")}
                        >
                            Add User
                        </a>
                        <h2 className="text-gray-900 mb-4 mt-4 font-medium">
                            List Users
                        </h2>
                        <table className="table">
                            <thead>
                                <tr className="text-gray-900">
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Created At</th>
                                    <th>Last Login</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {user.map((data, i) => (
                                    <tr
                                        key={i}
                                        className="hover:bg-gray-500 text-gray-900"
                                    >
                                        <td>1</td>
                                        <td>{data.username}</td>
                                        <td>{data.created_at}</td>
                                        <td>{data.last_login_at}</td>
                                        <td>
                                            <div className="dropdown">
                                                <div
                                                    tabIndex={0}
                                                    role="button"
                                                    className="btn m-1 bg-blue-500 text-white font-medium"
                                                >
                                                    Lock
                                                </div>
                                                <ul
                                                    tabIndex={0}
                                                    className="dropdown-content menu bg-gray-600 rounded-box z-[1] w-52 p-2 shadow text-white"
                                                >
                                                    <li>
                                                        <a>Item 1</a>
                                                    </li>
                                                    <li>
                                                        <a>Item 2</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <a
                                                href={`/update-user-form/${data.id}`}
                                                className="btn btn-warning mr-1"
                                            >
                                                Update
                                            </a>
                                            <button
                                                onClick={() => {
                                                    if (
                                                        confirm(
                                                            "yakin hapus data?"
                                                        )
                                                    ) {
                                                        Inertia.delete(
                                                            route(
                                                                "user-delete",
                                                                data.id
                                                            )
                                                        );
                                                    }
                                                }}
                                                className="btn btn-error"
                                            >
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </section>
            </AuthenticatedLayout>
        </>
    );
}
