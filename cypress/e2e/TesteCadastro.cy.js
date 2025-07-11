describe("Tela de Cadastro", () => {
  it("cadastro invalido", () => {
    cy.visit("http://localhost/projetoFinalProgramacaoWeb/cadastrar.php");
    cy.contains("Voce não tem acesso a essa pagina").should("be.visible");
  });
});
