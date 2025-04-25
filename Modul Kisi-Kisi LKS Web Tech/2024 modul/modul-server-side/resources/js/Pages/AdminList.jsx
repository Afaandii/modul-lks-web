import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function AdminList({ auth, admin }) {
    return (
        <>
            <AuthenticatedLayout
                user={auth.user}
                header={
                    <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                        Admin List
                    </h2>
                }
            >
                <Head title="Admin List" />

                <section className="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-5">
                    <div className="overflow-x-auto">
                        <h1 className="text-gray-900 mb-4 mt-4 font-medium">
                            Admin Users List
                        </h1>
                        <table className="table">
                            {/* head */}
                            <thead>
                                <tr className="text-gray-900">
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Created At</th>
                                    <th>Last Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                {admin.map((data, i) => (
                                    <tr
                                        key={i}
                                        className="hover:bg-gray-500 text-gray-900"
                                    >
                                        <td>1</td>
                                        <td>{data.username}</td>
                                        <td>{data.created_at}</td>
                                        <td>{data.last_login_at}</td>
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
