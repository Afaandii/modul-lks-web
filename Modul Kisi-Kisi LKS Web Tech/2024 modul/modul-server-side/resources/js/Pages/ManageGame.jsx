import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, usePage } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";

export default function ManageGame({ auth, game }) {
    console.log(game);
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
                            href={route("game-form-create")}
                        >
                            Add Game
                        </a>
                        <h2 className="text-gray-900 mb-4 mt-4 font-medium">
                            List Game
                        </h2>
                        <table className="table">
                            <thead>
                                <tr className="text-gray-900">
                                    <th>#</th>
                                    <th>Thumbnail</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {game.map((data, i) => (
                                    <tr
                                        key={i}
                                        className="hover:bg-gray-500 text-gray-900"
                                    >
                                        <td>1</td>
                                        <td>{data.thumbnail}</td>
                                        <td>{data.title}</td>
                                        <td>{data.description}</td>
                                        <td>
                                            <a
                                                href={`/detail-game/${data.slug}`}
                                                className="btn btn-primary mr-1"
                                            >
                                                Detail
                                            </a>
                                            <a
                                                href={`/edit-game/${data.id}`}
                                                className="btn btn-warning mr-1"
                                            >
                                                Edit
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
                                                                "delete-game",
                                                                data.slug
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
